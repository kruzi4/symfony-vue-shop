import {concatUrlByParams} from "../../../../../utils/url-generator";
import axios from "axios";
import {StatusCodes} from "http-status-codes";
import {apiConfig} from "../../../../../utils/settings";

const state = () => ({
    categories: [],
    staticStore: {
        orderId: window.staticStore.orderId,
        orderProducts: window.staticStore.orderProducts,

        url: {
            viewProduct: window.staticStore.urlViewProduct,
            apiOrderProduct: window.staticStore.urlAPIOrderProduct
        }
    }
})

const getters = {

}

const actions = {
    async removeOrderProduct({ state, dispatch }, orderProductId ) {
        const url = concatUrlByParams(
            state.staticStore.url.apiOrderProduct,
            orderProductId
        )

        const result = await axios.delete(url, apiConfig)

        if (result.status === StatusCodes.NO_CONTENT) {
            console.log('deleted')
        }
    }
}

const mutations = {

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}