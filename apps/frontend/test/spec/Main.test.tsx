import axios from 'axios'
import { create } from 'react-test-renderer'
import { render } from '@testing-library/react'
import Main from 'components/Main'

jest.mock('axios')
const mockedAxios = axios as jest.Mocked<typeof axios>


describe('Main component', () => {
  it('renders correctly', async () => {
    mockedAxios.get.mockResolvedValue({
      data: {
        payload: ""
      }
    })

    const container = create(<Main />)
    
    expect(container.toJSON()).toMatchSnapshot()
  })

  it('displays the message stored in the payload field', async () => {
    mockedAxios.get.mockResolvedValue({
      data: {
        payload: "test"
      }
    })

    const { findByText } = render(<Main />)
    
    expect(await findByText('test')).toBeTruthy()
  })
})
