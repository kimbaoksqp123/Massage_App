import { BrowserRouter, Routes, Route } from 'react-router-dom'
import User from './user'
import Admin from './admin'
import Owner from './owner'
import Login from '@/pages/Login'
// import Register from '@/pages/Register'

let type = localStorage.getItem("role");

const Router = () => {
//   const type = localStorage.getItem('type')
  return (
    <BrowserRouter>
      <Routes>
        <Route path="*" element={
          !type ? <Login></Login> : (type === "user" ? <User/> : type === "admin"? <Admin /> : <Owner/>)
        } />
        {/* <Route path="/register" element={<Register />} /> */}
      </Routes>
    </BrowserRouter>
  )
}

export default Router