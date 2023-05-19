import Axios from "./Axios";

export default {

  makeFilter(): Promise<any> {
    return Axios().get("api/filter/make");
  },

  yearFilter(): Promise<any> {
    return Axios().get("api/filter/year");
  },
  
};
