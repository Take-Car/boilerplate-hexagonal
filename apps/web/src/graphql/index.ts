import { gql } from '@apollo/client';
import * as Apollo from '@apollo/client';
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
  readonly users: ReadonlyArray<User>;
}

export interface User extends Identifiable {
  readonly __typename?: 'User';
  readonly id: Scalars['ID'];
}

export type UsersQueryVariables = Exact<{ [key: string]: never; }>;


export type UsersQuery = { readonly __typename?: 'Query', readonly users: ReadonlyArray<{ readonly __typename?: 'User', readonly id: string }> };


export const UsersDocument = gql`
    query Users {
  users {
    id
  }
}
    `;
export type UsersQueryResult = Apollo.QueryResult<UsersQuery, UsersQueryVariables>;