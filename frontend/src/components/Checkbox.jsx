import { useState } from 'react'
import './Checkbox.scss'
import SvgIcon from './SvgIcon'

export default function Checkbox( {valueIn, length, setVal, name}) {

    const [value, setValue] = useState(valueIn)

    const changeValue = () => {
        let i = value;
        i++;
        if(i > 1) i = -1;
        setValue(i);
        setVal(name, i);
    }
    return (
        <>
            <div className="checkbox" style={{width: length, height: length}} onClick={changeValue}>
                <div className="inside"> 
                    {!value? '' : 
                        value === 1 ? 
                            <SvgIcon name='check' length={length}/> : 
                            <SvgIcon name='not-include' length={length}/>
                    }
                </div>
            </div>
        </>
    )
}