
import { useNavigate } from "react-router-dom";
import Header from "@/components/Header"

export default function HomeUser() {

  const navigate = useNavigate();

  return (
    <>
    <Header></Header>
      <div>This is massage homepage</div>
      <div>
        
            <button onClick={() => navigate('/search')}>Search</button>
        
            <button onClick={() => navigate('/details')}>Details</button>
      </div>
    </>
  );
}
