import { useTodoListsQuery } from 'hooks/graphql'
import { FC } from 'react'
import TodoList from './TodoList/TodoList'

const Main: FC = () => {
  const { data, loading, error } = useTodoListsQuery()

  if (loading) return <>Loading...</>

  if (error) {
    console.error(error)

    return null
  }

  return <TodoList todoLists={data?.todoLists} />
}

export default Main