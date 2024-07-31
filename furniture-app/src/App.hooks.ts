import { useMemo, useReducer } from "react"
import { useSearchParams } from "react-router-dom"
import { TFilters } from "./types"

const options = { replace: true, preventScrollReset: true }

export function useURLSearchParams() {
  const [, setParams] = useSearchParams()

  return (
    actionType: `add` | `remove` | `replace`,
    value: string,
    type: string
  ) => {
    const params = new URLSearchParams(window.location.search)
    const existingParams = Object.fromEntries(params)
    const currentValues = existingParams[type]
      ? existingParams[type].split(`,`)
      : []

    if (actionType === `add`) {
      const newValues = [...currentValues, value]

      setParams(
        {
          ...existingParams,
          [type]: newValues.join(`,`),
        },
        options
      )
    }

    if (actionType === `remove`) {
      const newValues = currentValues.filter((v) => v !== value)

      if (newValues.length === 0) {
        delete existingParams[type]

        return setParams(existingParams, options)
      }

      setParams(
        {
          ...existingParams,
          [type]: newValues.join(`,`),
        },
        options
      )
    }

    if (actionType === `replace`) {
      setParams(
        {
          ...existingParams,
          [type]: value,
        },
        options
      )
    }
  }
}

export function useFilters() {
  const [params] = useSearchParams()
  const initial = useMemo(() => getInitialState(params), [])

  return useReducer(reducer, initial)
}

interface TAction {
  type: `add` | `remove`
  payload: {
    type: string
    value: string[]
  }
}

function reducer(state: TFilters, action: TAction) {
  if (action.type === `add`) {
    const set = new Set([
      ...state[action.payload.type],
      ...action.payload.value,
    ])
    const uniq = [...Array.from(set)]

    return {
      ...state,
      [action.payload.type]: uniq,
    }
  }

  if (action.type === `remove`) {
    const set = new Set(state[action.payload.type])
    action.payload.value.forEach((v) => {
      set.delete(v)
    })
    const uniq = [...Array.from(set)]

    return {
      ...state,
      [action.payload.type]: uniq,
    }
  }

  return state
}

function getInitialState(params) {
  const paramsObject = Object.fromEntries(params.entries())

  return {
    color: paramsObject.color ? paramsObject.color.split(`,`) : [],
    furniture_type: paramsObject.furniture_type
      ? paramsObject.furniture_type.split(`,`)
      : [],
  }
}
