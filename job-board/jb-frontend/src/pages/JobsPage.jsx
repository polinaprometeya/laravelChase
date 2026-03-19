import "../styles/JobBoard.css";
import { useState, useEffect } from "react";
import { getJobs } from "../services/routes";
import Card from "../components/Card";

export default function JobsPage() {
  const [jobsData, setJobsData] = useState([]);

  useEffect(() => {
    loadJobs();
  }, []);

  async function loadJobs() {
    try {

      const response = await getJobs();
      const responseData = response?.data?.data ?? response?.data ?? [];

      setJobsData(Array.isArray(responseData) ? responseData : []);

    } catch (err) {
      console.error("Error fetching jobs:", err);
      setJobsData([]);
    } 
  }

  return (
    <>
        <table>
          <tbody >
            <tr>
                       
              {jobsData.map((job) => (
              <Card> 
                <td key={job.id}>{job.title}</td>
              </Card>
            ))}
            
            </tr>
          </tbody>
        </table>
    </>
  );
}
