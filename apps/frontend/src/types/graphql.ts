export type Maybe<T> = T | null | undefined;
export type InputMaybe<T> = T | null | undefined;
export type Exact<T extends { [key: string]: unknown }> = { [K in keyof T]: T[K] };
export type MakeOptional<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]?: Maybe<T[SubKey]> };
export type MakeMaybe<T, K extends keyof T> = Omit<T, K> & { [SubKey in K]: Maybe<T[SubKey]> };
/** All built-in and custom scalars, mapped to their actual values */
export interface Scalars {
  ID: string;
  String: string;
  Boolean: boolean;
  Int: number;
  Float: number;
}

export interface Identifiable {
  readonly id: Scalars['ID'];
}

export interface Query {
  readonly __typename?: 'Query';
  readonly todoLists: ReadonlyArray<TodoList>;
}

export interface Todo extends Identifiable {
  readonly __typename?: 'Todo';
  readonly id: Scalars['ID'];
  readonly isDone: Scalars['Boolean'];
  readonly task: Scalars['String'];
}

export interface TodoList extends Identifiable {
  readonly __typename?: 'TodoList';
  readonly id: Scalars['ID'];
  readonly length: Scalars['Int'];
  readonly title: Scalars['String'];
  readonly todos: ReadonlyArray<Todo>;
}
