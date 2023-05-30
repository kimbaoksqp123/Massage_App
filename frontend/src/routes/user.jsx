import { Routes, Route, Navigate } from 'react-router-dom'

// import * as Notfound from '@/Pages/Error'
import Search from '@/pages/User/Search'
import HomeUser from '@/pages/User/Home'
import Details from '@/pages/User/Details'

const User = () =>{
    return (
        <Routes>
        <Route path="/" element={ <HomeUser />} />
        <Route path="/login" element={ <Navigate to={'/search'} />} />
        <Route path='/search/*' element={<Search />} />
        <Route path='/details/*' element={<Details />} />
        {/* <Route path="*" element={<Notfound></Notfound>}/> */}
      </Routes>
    )
}

export default User