import type { TodoListsQuery } from 'hooks/graphql'
import { FC } from 'react'

type Props = {
  todoLists: TodoListsQuery['todoLists']
}

const TodoList: FC<Props> = ({ todoLists }) =>
  <pre>
    {JSON.stringify({ todoLists }, null, '\t')}
  </pre>

export default TodoList
