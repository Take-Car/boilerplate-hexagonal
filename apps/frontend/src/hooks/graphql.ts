import { gql } from '@apollo/client'
import * as Apollo from '@apollo/client'
export type Maybe<T> = T | null;
export type InputMaybe<T> = Maybe<T>;
export type Exact<T extends { readonly [key: string]: unknown }> = { readonly [K in keyof T]: T[K] };
export type MakeOptional<T, K extends keyof T> = Omit<T, K> & { readonly [SubKey in K]?: Maybe<T[SubKey]> };
export type MakeMaybe<T, K extends keyof T> = Omit<T, K> & { readonly [SubKey in K]: Maybe<T[SubKey]> };
const defaultOptions = {} as const
/** All built-in and custom scalars, mapped to their actual values */
export type Scalars = {
  readonly ID: string;
  readonly String: string;
  readonly Boolean: boolean;
  readonly Int: number;
  readonly Float: number;
};

export type Identifiable = {
  readonly id: Scalars['ID'];
};

export type Query = {
  readonly __typename?: 'Query';
  readonly todoLists: ReadonlyArray<TodoList>;
};

export type Todo = Identifiable & {
  readonly __typename?: 'Todo';
  readonly id: Scalars['ID'];
  readonly isDone: Scalars['Boolean'];
  readonly task: Scalars['String'];
};

export type TodoList = Identifiable & {
  readonly __typename?: 'TodoList';
  readonly id: Scalars['ID'];
  readonly length: Scalars['Int'];
  readonly title: Scalars['String'];
  readonly todos: ReadonlyArray<Todo>;
};

export type TodoListsQueryVariables = Exact<{ readonly [key: string]: never; }>;


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