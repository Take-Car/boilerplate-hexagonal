import { useQuery } from '@apollo/client'
import { UsersDocument, UsersQuery, UsersQueryVariables } from '@/graphql'

const Main = () => {
  const { data, loading } = useQuery<UsersQuery, UsersQueryVariables>(UsersDocument)

  if (loading)
    return (
      <main>
        <b>Loading</b>
      </main>
    )

  return (
    <main>
      <h1>Hello world</h1>
      {
        data.users.map(user => <p key={user.id}>{`User ID: ${user.id}`}</p>)
      }
    </main>
  )
}

export default Main