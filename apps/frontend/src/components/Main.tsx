import useFetch from 'hooks/useFetch'
import { StrictMode, useState } from 'react'

export default function Main() {
  const [msg, setMsg] = useState()

  const fetch = useFetch('hello', 'get')

  fetch()
    .then(({ data }: any) => {
      setMsg(data.payload)
    })
  
  return (
    <StrictMode>
      <p>{msg}</p>
    </StrictMode>
  )
}
