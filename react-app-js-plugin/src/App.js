import { BrowserRouter, Route, Routes } from 'react-router-dom';
import './App.css';
import Execute from './Execute';
import Return from './Return';
// import { authentication } from "./Shurjopay.js";
//const {authonetication}=require('./ShurjoPay.js')

function App() {
  // console.log(authentication())
  // console.log(token_valid)
  return (
    <div>
      <BrowserRouter>
      <Routes>
        <Route exact path='/' element={<Execute/>}/>
        <Route path='/payment' element={<Execute/>}/>
        <Route path='/return' element={<Return/>}/>
      </Routes>
      </BrowserRouter>
    
    </div>
  );
}

export default App;
