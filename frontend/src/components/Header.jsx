import "./Header.scss";
import { useState } from "react";

export default function Header() {

    const [role, setRole] = useState(localStorage.getItem('role'))
    const [open, setOpen] = useState(true);

    const setting = (role) => {
        setRole(role);
        localStorage.setItem("role", role);
        window.location.reload();
    };

    return (
        <div className="page-header">
            <div className="header-control">
                <div className="role-show">
                {role ? (
                    <div>Current role is: // {role} \\ </div>
                ) : (
                    <div> Currently no role selected</div>
                )}
                </div>
                <div className="header-open" onClick={() => setOpen(!open)}> {open ? '^' : 'v'} </div>
            </div>
            {open ? <div className="header-content">
                {role !== "user" ? (
                    <button onClick={() => setting("user")}>Click here to become user</button>
                ) : (
                    ""
                )}
                {role === "owner" ? (
                    ""
                ) : (
                    <button onClick={() => setting("owner")}>Click here to become owner</button>
                )}
                {role === "admin" ? (
                    <></>
                ) : (
                    <button onClick={() => setting("admin")}>Click here to become admin</button>
                )}

            </div> : <></>}
            
        </div>
    );
}
