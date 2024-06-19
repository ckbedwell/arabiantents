import { render } from '@testing-library/react'
import { screen } from '@testing-library/dom'
import { App } from '~/App'

describe(`<App />`, () => {
  it(`shows the right text`, () => {
    render(<App />)
    expect(screen.getByText(`Check that nesting works`)).toBeInTheDocument()
  })
})
