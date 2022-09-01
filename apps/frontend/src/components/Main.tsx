import { FC } from 'react'
import { useTodoListsQuery } from 'hooks/graphql'
import TodoList from 'components/TodoList'

const Main: FC = () => {
  const { data, loading, error } = useTodoListsQuery()

  return loading || error
    ? null
    : <TodoList todoLists={data?.todoLists} />
}

export default Main