import axios, { ResponseType } from 'axios'

const host = process.env.API_HOST

axios.defaults.baseURL = host
axios.defaults.headers.common['Content-Type'] = 'application/x-www-form-urlencoded'

type Method = 'getUri' | 'request' | 'get' | 'delete' | 'head' | 'options' | 'post' | 'put' | 'patch' | 'postForm' | 'putForm' | 'patchForm'

export default function useFetch(endpoint: string, method: Method, responseType: ResponseType = 'json') {
  return async (data?: any, params?: Record<string,string|number>) => {

    const url = params !== undefined
      ? Object.entries(params)
        .reduce(([key, value]) => endpoint.replace(`:${key}`, value), endpoint)
      : endpoint

    const response = await axios[method](url, { responseType, data })

    return response
  }
}
