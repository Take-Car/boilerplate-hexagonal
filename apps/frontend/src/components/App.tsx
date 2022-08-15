import { ApolloClient, ApolloProvider, InMemoryCache } from '@apollo/client'
import { StrictMode } from 'react'
import Main from './Main'

const client = new ApolloClient({
  uri: `${process.env.API_HOST}/graphql/`,
  cache: new InMemoryCache()
})

export default function App() {

  return (
    <StrictMode>
      <ApolloProvider client={client}>
        <Main />
      </ApolloProvider>
    </StrictMode>
  )
}
