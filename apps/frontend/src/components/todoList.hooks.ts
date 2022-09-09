import * as Types from 'types/graphql'

import { gql } from '@apollo/client'
import * as Apollo from '@apollo/client'
const defaultOptions = {} as const
export type TodoListsQueryVariables = Types.Exact<{ [key: string]: never; }>;


export type TodoListsQuery = { readonly __typename?: 'Query', readonly todoLists: ReadonlyArray<{ readonly __typename?: 'TodoList', readonly id: string, readonly title: string, readonly length: number, readonly todos: ReadonlyArray<{ readonly __typename?: 'Todo', readonly id: string, readonly task: string, readonly isDone: boolean }> }> };


export const TodoListsDocument = gql`
    query TodoLists {
  todoLists {
    id
    title
    length
    todos {
      id
      task
      isDone
    }
  }
}
    `

/**
 * __useTodoListsQuery__
 *
 * To run a query within a React component, call `useTodoListsQuery` and pass it any options that fit your needs.
 * When your component renders, `useTodoListsQuery` returns an object from Apollo Client that contains loading, error, and data properties
 * you can use to render your UI.
 *
 * @param baseOptions options that will be passed into the query, supported options are listed on: https://www.apollographql.com/docs/react/api/react-hooks/#options;
 *
 * @example
 * const { data, loading, error } = useTodoListsQuery({
 *   variables: {
 *   },
 * });
 */
export function useTodoListsQuery(baseOptions?: Apollo.QueryHookOptions<TodoListsQuery, TodoListsQueryVariables>) {
  const options = {...defaultOptions, ...baseOptions}
  return Apollo.useQuery<TodoListsQuery, TodoListsQueryVariables>(TodoListsDocument, options)
}
export function useTodoListsLazyQuery(baseOptions?: Apollo.LazyQueryHookOptions<TodoListsQuery, TodoListsQueryVariables>) {
  const options = {...defaultOptions, ...baseOptions}
  return Apollo.useLazyQuery<TodoListsQuery, TodoListsQueryVariables>(TodoListsDocument, options)
}
export type TodoListsQueryHookResult = ReturnType<typeof useTodoListsQuery>;
export type TodoListsLazyQueryHookResult = ReturnType<typeof useTodoListsLazyQuery>;
export type TodoListsQueryResult = Apollo.QueryResult<TodoListsQuery, TodoListsQueryVariables>;