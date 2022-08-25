import { render as renderReact } from '@testing-library/react'
import { MockedProvider, MockedResponse } from '@apollo/client/testing'
import Main from 'components/Main'
import { TodoListsDocument } from 'graphql'

const mocks: MockedResponse[] = [
  {
    request: { query: TodoListsDocument },
    result: {
      data: {
        todoLists: {
          id: 1,
          title: 'test',
          length: 1,
          todos: {
            id: 1,
            task: 'test task',
            isDone: false
          }
        }
      }
    }
  }
]

const render = () => renderReact(
  <MockedProvider
    mocks={mocks}
    addTypename={false}
  >
    <Main />
  </MockedProvider>
)

describe('Main component', () => {
  it('renders correctly', () => {
    const { container } = render()
    
    expect(container).toMatchSnapshot()
  })

  it('displays the message stored in the payload field', async () => {
    const { findByText } = render()
    
    expect(await findByText('test')).toBeTruthy()
  })
})
