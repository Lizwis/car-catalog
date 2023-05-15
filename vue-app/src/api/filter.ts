import Axios from "./Axios";

export default {

  makeFilter(): Promise<any> {
    return Axios().get("api/filter/make");
  },
  
};
