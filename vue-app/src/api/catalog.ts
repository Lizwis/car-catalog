import Axios from "./Axios";

export default {
  listCatelog(makeFilter:any): Promise<any> {
    return Axios().post("api/catalog/cars", makeFilter);
  },

  listCategories(): Promise<any> {
    return Axios().get("api/catalog/category");
  },
  
};
