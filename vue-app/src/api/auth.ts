import Axios from "./Axios";

export default {

  crsfToken(){
    return Axios().get("/sanctum/csrf-cookie")
  },


  logout(): Promise<any> {
    return Axios().post("/logout");
  },

  auth(): Promise<any> {
    return Axios().get("/api/user");
  },
};
