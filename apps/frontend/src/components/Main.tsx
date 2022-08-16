import { useTodoListsQuery } from 'hooks/graphql'
import { FC } from 'react'
import TodoList from './TodoList'

const Main: FC = () => {
  const { data, loading, error } = useTodoListsQuery()

  return loading || error
    ? null
    : <TodoList todoLists={data?.todoLists} />
}

export default Main