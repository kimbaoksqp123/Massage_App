import { useNavigate } from "react-router-dom";

export default function Details() {
  const navigate = useNavigate();

  return (
    <div className="returnHome">
        <p>Details page here</p>
      <button onClick={() => navigate("/")}>Home</button>
      <button onClick={() => navigate("/search")}>Search</button>

    </div>
  );
}
