import api from "./api";

//Read 

export const getJobs = () => api.get("/jobs");

