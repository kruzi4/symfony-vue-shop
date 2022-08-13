export function getProductInformativeTitle(product) {
    return (
        '#'
        + product.id
        + ' '
        + product.Title
        + " / P: $"
        + product.price
        + " / Q: "
        + product.quantity
    )
}