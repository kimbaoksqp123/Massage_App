
export default function SvgIcon(props) {
    
    const url = `${props.name}.${props.type ? props.type : 'svg'}`


    return (
        <img src={url} alt='icon' style={{width: props.width, height: props.height}}/>
    )
}