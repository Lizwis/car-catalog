import { default as axios } from 'axios'


const BaseApi = axios.create({

  baseURL: "http://localhost:8000",
});


const Api = function () {

  BaseApi.defaults.withCredentials = true;

  return BaseApi;
};



export default Api;
