import { Routes, Route, Navigate } from 'react-router-dom'
import HomeAdmin from '@/pages/Admin/Home'

const Admin = () =>{
    return (
        <Routes>
        <Route path="*" element={ <HomeAdmin />} />
        {/* <Route path="/login" element={ <Navigate to={'/search'} />} />
        <Route path='/search/*' element={<Search />} />
        <Route path="*" element={<Notfound></Notfound>}/> */}
      </Routes>
    )
}

export default Admin