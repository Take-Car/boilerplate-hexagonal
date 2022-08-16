import { createElement } from 'react'
import { render } from 'react-dom'
import App from 'components/App'

import 'styles/index.scss'

// eslint-disable-next-line functional/no-expression-statement
render(createElement(App), document.getElementById('root'))
