import "./styles/App.css";
import MainLayout from "./layouts/MainLayout.jsx";
import JobsPage from "./pages/JobsPage.jsx";

export default function App() {
  return (
    <MainLayout>
      <p>Job Board Posts</p>
      <JobsPage />
    </MainLayout>
  );
}
