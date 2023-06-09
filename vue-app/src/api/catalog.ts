import Axios from "./Axios";

export default {
  listCatelog(makeFilter:any): Promise<any> {
    return Axios().post("api/catalog/cars", makeFilter);
  },

  listCategories(): Promise<any> {
    return Axios().get("api/catalog/category");
  },

  updatePrice(id:any, form:any): Promise<any> {
    return Axios().post(`api/catalog/cars/update/${id}`,form);
  },
  
};
