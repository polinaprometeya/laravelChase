import "../styles/App.css";
import { useState, useEffect } from "react";
import { getJobs } from "../services/routes";

export default function JobsPage() {
  const [jobsData, setJobsData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    loadJobs();
  }, []);

  async function loadJobs() {
    try {
      setLoading(true);
      setError(null);
      const response = await getJobs();
      const responseData = response?.data?.data ?? response?.data ?? [];
      setJobsData(Array.isArray(responseData) ? responseData : []);
    } catch (err) {
      console.error("Error fetching jobs:", err);
      setError("Could not load jobs. Please try again.");
      setJobsData([]);
    } finally {
      setLoading(false);
    }
  }

  return (
    <>
      {loading && <p>Loading jobs…</p>}
      {error && !loading && <p>{error}</p>}
      {!loading && !error && (
        <table>
          <tbody>
            {jobsData.map((job) => (
              <tr key={job.id}>
                <td>{job.title}</td>
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </>
  );
}
