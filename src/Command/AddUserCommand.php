<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class AddUserCommand extends Command
{
    protected static $defaultName = 'app:add-user';
    protected static $defaultDescription = 'Create user';
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $encoder;
    private UserRepository $userRepository;

    public function __construct(string $name = null, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder, UserRepository $userRepository)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
        $this->userRepository = $userRepository;
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addOption('email', 'em', InputArgument::REQUIRED, 'Email')
            ->addOption('password', 'p',  InputArgument::REQUIRED, 'Password')
            ->addOption('isAdmin', '', InputArgument::OPTIONAL, 'Is user admin', 0)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $input->getOption('email');
        $password = $input->getOption('password');
        $isAdmin = $input->getOption('isAdmin');

        $stopwatch = new Stopwatch();
        $stopwatch->start('add-user-command');

        $io->title('Add User Command Wizard');

        $io->text([
            'Please enter some information'
        ]);

        if (!$email) {
            $email = $io->ask('Email');
        }

        if (!$password) {
            $password = $io->askHidden('Password (your type will be hidden)');
        }

        if (!$isAdmin) {
            $question = new Question('Is admin? (1 or 0)', 0);
            $isAdmin = $io->askQuestion($question);
        }

        $isAdmin = (bool)$isAdmin;

        try {
            $user = $this->createUser($email, $password, $isAdmin);
        } catch (RuntimeException $e) {
            $io->comment($e->getMessage());

            return Command::FAILURE;
        }

        $successMessage = sprintf('%s was successfully created: %s',
            $isAdmin ? 'Administrator' : 'User',
            $email
        );
        $io->success($successMessage);

        $event = $stopwatch->stop('add-user-command');
        $stopWatchMessage = sprintf('New user\'s id: %d / Elapsed time: %.2f ms / Consumed memory: %.2f MB',
            $user->getId(),
            $event->getDuration(),
            $event->getMemory() / 1000 / 1000
        );

        $io->comment($stopWatchMessage);
        return Command::SUCCESS;
    }

    /**
     * @param $email
     * @param $password
     * @param bool $isAdmin
     * @return User
     */
    private function createUser($email, $password, bool $isAdmin) : User
    {
        $existingUser = $this->userRepository->findBy(['email' => $email]);

        if ($existingUser) {
            throw new RuntimeException('User already exist');
        }

        $user = new User();
        $user->setEmail($email);
        $user->setRoles([$isAdmin ? 'ROLE_ADMIN' : 'ROLE_USER']);

        $encodedPassword = $this->encoder->encodePassword($user, $password);
        $user->setPassword($encodedPassword);

        $user->isVerified(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
