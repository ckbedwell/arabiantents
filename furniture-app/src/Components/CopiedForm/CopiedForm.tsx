import React, { ChangeEvent, FormEvent, useState } from 'react'
import classNames from 'classnames'
import styles from './CopiedForm.module.css'

export const CopiedForm = () => {
  return (
    <div className="contact-form">
      <div className={styles.widthContain}>
        <div className="grid">
          <Info />
          <Form />
        </div>
      </div>
    </div>
  )
}

const Info = () => {
  return (
    <div>
      <h2 className="secondary contact-form__title">Tell us about your Event!</h2>
      <p>We look forward to hearing what you're planning; when you get in touch do let us know:</p>
      <ul>
        <li>
          the number of guests you're expecting
        </li>
        <li>
          what tent/ furniture/ service you are interested in
        </li>
        <li>
          the date of your event
        </li>
        <li>
          the delivery location
        </li>
      </ul>
      <p>
        We have limited our delivery distance to within 100 miles of our West Sussex base to help reduce carbon emissions.
      </p>
      <p>
        Ask about our Eco tips for your next event.
      </p>
      <p>
        <strong>Your furniture basket will be included in your enquiry.</strong>
      </p>
    </div>
  )
}

const initialErrorState = {
  field_name: false,
  field_email: false,
  field_telephone: false,
  field_events: false,
  field_date: false,
  field_postcode: false,
  field_message: false,
}

const Form = () => {
  const [formData, setFormData] = useState({
    field_name: ``,
    field_email: ``,
    field_telephone: ``,
    field_events: ``,
    field_date: ``,
    field_postcode: ``,
    field_message: ``,
  })

  const [errors, setErrors] = useState(initialErrorState)

  const handleChange = (e: ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const {
      name,
      value,
    } = e.target
    setFormData({
      ...formData,
      [name]: value,
    })

    const validateMap = {
      field_name: validateName,
      field_email: validateEmail,
      field_telephone: validateTelephone,
      field_events: validateEvent,
      field_date: validateDate,
      field_postcode: validatePostcode,
      field_message: validateMessage,
    }

    if (validateMap[name]) {
      const isValid = validateMap[name](value)

      setErrors({
        ...errors,
        [name]: !isValid,
      })
    }
  }

  const validate = () => {
    let valid = true
    let errState = { ...initialErrorState }

    if (!formData.field_name) {
      errState.field_name = true
      valid = false
    }

    if (!formData.field_email || !/\S+@\S+\.\S+/.test(formData.field_email)) {
      errState.field_email = true
      valid = false
    }

    if (!formData.field_email) {
      errState.field_telephone = true
      valid = false
    }

    if (!formData.field_events) {
      errState.field_events = true
      valid = false
    }

    if (!formData.field_date) {
      errState.field_date = true
      valid = false
    }

    if (!formData.field_postcode) {
      errState.field_postcode = true
      valid = false
    }

    if (!formData.field_message) {
      errState.field_message = true
      valid = false
    }

    setErrors(errState)
    return valid
  }

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    if (!validate()) {
      e.preventDefault()
    }
  }

  return (
    <form
      action="thank-you-test"
      method="post"
      onSubmit={handleSubmit}
    >
      <div className="fields-wrapper">
        <div className="grid-3 grid-1-t gap-2">
          <div
            className={classNames(`input-field field_name`, {
              error: errors.field_name,
            })}
          >
            <div className="flex gap-1">
              <label className="heading-label">Your name:</label>
            </div>
            <input
              id="field_name"
              name="field_name"
              onChange={handleChange}
              placeholder="Name"
              type="text"
            />
            <div className="error-message">
              Please enter your name
            </div>
          </div>
          <div
            className={classNames(`input-field field_email`, {
              error: errors.field_email,
            })}
          >
            <div className="flex gap-1">
              <label className="heading-label">Your email:</label>
            </div>
            <input
              id="field_email"
              name="field_email"
              onChange={handleChange}
              placeholder="john@smith.com"
              type="email"
            />
            <div className="error-message">
              Please enter a valid email address
            </div>
          </div>
          <div
            className={classNames(`input-field field_telephone`, {
              error: errors.field_telephone,
            })}
          >
            <div className="flex gap-1">
              <label className="heading-label">Your telephone:</label>
            </div>
            <input
              id="field_telephone"
              name="field_telephone"
              onChange={handleChange}
              placeholder="telephone"
              type="tel"
            />
            <div className="error-message">
              Please enter a valid telephone number
            </div>
          </div>
        </div>

        <div>
          <div
            className={classNames(`input-field field_events`, {
              error: errors.field_events,
            })}
          >
            <label className="heading-label">What is your event?</label>
            <div className="grid-4 grid-2-t gap-2">
              <input
                id="Wedding"
                name="field_events"
                onChange={handleChange}
                type="radio"
                value="Wedding"
              />
              <label
                className="action-button"
                htmlFor="Wedding"
              >
                Wedding
              </label>
              <input
                id="Party"
                name="field_events"
                onChange={handleChange}
                type="radio"
                value="Party"
              />
              <label
                className="action-button"
                htmlFor="Party"
              >
                Party
              </label>
              <input
                id="Corporate Event"
                name="field_events"
                type="radio"
                value="Corporate Event"
              />
              <label
                className="action-button"
                htmlFor="Corporate Event"
              >
                Corporate Event
              </label>
              <input
                id="Festival"
                name="field_events"
                onChange={handleChange}
                type="radio"
                value="Festival"
              />
              <label
                className="action-button"
                htmlFor="Festival"
              >
                Festival
              </label>
            </div>
            <div className="error-message">
              Please select an event type
            </div>
          </div>
        </div>
        <div className="grid-2 grid-1-m gap-2">
          <div
            className={classNames(`input-field field_date`, {
              error: errors.field_date,
            })}
          >
            <div className="flex gap-1">
              <label className="heading-label">When?</label>
            </div>
            <input
              id="field_date"
              name="field_date"
              onChange={handleChange}
              placeholder=""
              type="date"
            />
            <div className="error-message">
              Please enter a valid date
            </div>
          </div>
          <div
            className={classNames(`input-field field_postcode`, {
              error: errors.field_postcode,
            })}
          >
            <div className="flex gap-1">
              <label className="heading-label">What's the location of your venue?</label>
            </div>
            <input
              id="field_postcode"
              name="field_postcode"
              onChange={handleChange}
              placeholder="Postcode / location"
              type="text"
            />
            <div className="error-message">
              Please enter a location
            </div>
          </div>
        </div>
        <div
          className={classNames(`input-field field_message`, {
            error: errors.field_message,
          })}
        >
          <div className="flex gap-1">
            <label className="heading-label">Your message:</label>
          </div>
          <textarea
            id="field_message"
            name="field_message"
            onChange={handleChange}
            placeholder=""
            rows={8}
          />
          <div className="error-message">
            Please enter a message
          </div>
        </div>
      </div>

      <input
        name="which-form"
        type="hidden"
        value="Furniture Enquiry Form"
      />
      <input
        name="page-url"
        type="hidden"
        value={window.location.origin + window.location.pathname}
      />
      <input
        className="action-button"
        data-id="quick-form"
        id="submit_results"
        name="quick-form"
        placeholder="Submit"
        type="submit"
      />
      <input
        name="js-enabled"
        readOnly
        type="hidden"
        value="js-enabled"
      />
    </form>
  )
}

function validateName(name: string) {
  return name.length > 0
}

function validateEmail(email: string) {
  return /\S+@\S+\.\S+/.test(email)
}

function validateTelephone(telephone: string) {
  return telephone.length > 0
}

function validateEvent(event: string) {
  return event.length > 0
}

function validateDate(date: string) {
  return date.length > 0
}

function validatePostcode(postcode: string) {
  return postcode.length > 0
}

function validateMessage(message: string) {
  return message.length > 0
}
