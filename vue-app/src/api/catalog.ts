import Axios from "./Axios";

export default {
  listCatelog(): Promise<any> {
    return Axios().get("api/catalog/cars");
  },
  listCategories(): Promise<any> {
    return Axios().get("api/catalog/category");
  },
  
};
