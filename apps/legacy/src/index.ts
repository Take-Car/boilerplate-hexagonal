import { createElement } from 'react'
import { createRoot } from 'react-dom/client'

import '@/styles/index.scss'
import App from '@/components/App'

const root = createRoot(document.getElementById('root'))
root.render(createElement(App))
