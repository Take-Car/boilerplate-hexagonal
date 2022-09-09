import { useTodoListsQuery } from 'hooks/graphql'

export default function TodoList() {
  const {data, loading, error} = useTodoListsQuery()

  if (error) return (
    <pre>{JSON.stringify(error, null, '  ')}</pre>
  )

  if (loading) return null

  return (
    <main>
      <h1>Mes listes</h1>
      {
        data.todoLists
          .map(todolist =>
            <article key={todolist.id}>
              <h2>{todolist.title}</h2>
              <section>
                {
                  todolist.todos
                    .map(
                      todo =>
                        <span key={todo.id}>
                          <input
                            type="checkbox"
                            checked={todo.isDone}
                          />
                          <input value={todo.task} />
                        </span>
                    )
                }
              </section>
            </article>  
          )
      }
    </main>
  )
}
