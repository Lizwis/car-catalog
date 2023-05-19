import Axios from "./Axios";

export default {

  listcars(): Promise<any> {
    return Axios().get("api/soap");
  },
  
};
