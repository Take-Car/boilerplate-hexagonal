import { gql } from '@apollo/client';
import * as Apollo from '@apollo/client';
export type Maybe<T> = T | null;
export type InputMaybe<T> = Maybe<T>;
export type Exact<T extends { [key: string]: unknown }> = { [K in keyof T]: T[K] };
export type MakeOptional<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]?: Maybe<T[SubKey]> };
export type MakeMaybe<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]: Maybe<T[SubKey]> };
const defaultOptions = {} as const;
/** All built-in and custom scalars, mapped to their actual values */
export type Scalars = {
  ID: string;
  String: string;
  Boolean: boolean;
  Int: number;
  Float: number;
};

export type Identifiable = {
  id: Scalars['ID'];
};

export type Query = {
  __typename?: 'Query';
  todoLists: Array<TodoList>;
};

export type Todo = Identifiable & {
  __typename?: 'Todo';
  id: Scalars['ID'];
  isDone: Scalars['Boolean'];
  task: Scalars['String'];
};

export type TodoList = Identifiable & {
  __typename?: 'TodoList';
  id: Scalars['ID'];
  length: Scalars['Int'];
  title: Scalars['String'];
  todos: Array<Todo>;
};

export type TodoListsQueryVariables = Exact<{ [key: string]: never; }>;


export type TodoListsQuery = { __typename?: 'Query', todoLists: Array<{ __typename?: 'TodoList', id: string, title: string, length: number, todos: Array<{ __typename?: 'Todo', id: string, task: string, isDone: boolean }> }> };


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
    `;

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
        return Apollo.useQuery<TodoListsQuery, TodoListsQueryVariables>(TodoListsDocument, options);
      }
export function useTodoListsLazyQuery(baseOptions?: Apollo.LazyQueryHookOptions<TodoListsQuery, TodoListsQueryVariables>) {
          const options = {...defaultOptions, ...baseOptions}
          return Apollo.useLazyQuery<TodoListsQuery, TodoListsQueryVariables>(TodoListsDocument, options);
        }
export type TodoListsQueryHookResult = ReturnType<typeof useTodoListsQuery>;
export type TodoListsLazyQueryHookResult = ReturnType<typeof useTodoListsLazyQuery>;
export type TodoListsQueryResult = Apollo.QueryResult<TodoListsQuery, TodoListsQueryVariables>;