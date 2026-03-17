import "../styles/App.css";
import Header from "../components/Header.jsx";

export default function MainLayout({ children }) {
  return (
    <>
      <Header />
      <main>{children}</main>
    </>
  );
}
