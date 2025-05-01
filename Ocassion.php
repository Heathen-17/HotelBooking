<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Your Special Occasion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3.2.0/dist/email.min.js"></script>
  <script type="text/javascript">
    emailjs.init('NoAl1E4hp-t5XkRpj'); // Replace with your EmailJS user ID
  </script>

<?php require('inc\header.php');?>

  <style>
    :root {
      --primary-color: #003580;
      --secondary-color: #0071c2;
      --accent-color: #febb02;
      --text-dark: #2c2c2c;
      --text-light: #ffffff;
      --background-light: #f7f7f7;
      --border-color: #e0e0e0;
      --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      --birthday-color: #0071c2;
      --anniversary-color: #d81b60;
      --corporate-color: #388e3c;
      --custom-color: #f57c00;
      --custom-light: #ffa726;
    }

    body {
      background-color: var(--background-light);
      color: var(--text-dark);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      letter-spacing: 0.01em;
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      border: none;
      background: #ffffff;
      overflow: hidden;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .occasion-card {
      border-width: 2px;
      cursor: pointer;
      padding: 1rem;
      height: 100%;
      max-height: 200px;
      background: #ffffff;
      transition: border-color 0.3s ease;
    }

    .occasion-card:hover {
      border-color: var(--primary-color) !important;
    }

    .occasion-card.birthday { border-color: var(--birthday-color); }
    .occasion-card.anniversary { border-color: var(--anniversary-color); }
    .occasion-card.corporate { border-color: var(--corporate-color); }
    .occasion-card.custom { border-color: var(--custom-color); }

    .icon-circle {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--primary-color);
      color: var(--text-light);
      margin: 0 auto 1rem;
      transition: background-color 0.3s ease;
    }

    .icon-circle i {
      font-size: 1.5rem;
      font-weight: 600;
    }

    .date-box {
      background-color: #ffffff;
      border: 2px solid var(--border-color);
      color: var(--text-dark);
      border-radius: 8px;
      padding: 0.75rem;
      text-align: center;
      cursor: default;
      font-size: 0.9rem;
      font-weight: 500;
      width: 100%;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-sizing: border-box;
      overflow: hidden;
      word-break: break-word;
      flex: 1;
    }

    .date-box.birthday { border-color: var(--birthday-color); background-color: rgba(0, 113, 194, 0.1); }
    .date-box.anniversary { border-color: var(--anniversary-color); background-color: rgba(216, 27, 96, 0.1); }
    .date-box.corporate { border-color: var(--corporate-color); background-color: rgba(56, 142, 60, 0.1); }
    .date-box.custom { border-color: var(--custom-color); background-color: rgba(255, 167, 38, 0.2); }

    .date-box-selectable {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .date-box-selectable:hover {
      border-color: var(--primary-color) !important;
    }

    .date-box-selectable.selected {
      border-color: var(--secondary-color);
      font-weight: 600;
    }

    .form-header {
      background-color: var(--primary-color);
      color: var(--text-light);
      padding: 1.25rem;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
      font-weight: 600;
    }

    .contact-footer {
      background-color: #ffffff;
      border: 1px solid var(--border-color);
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      padding: 2rem;
    }

    .page-title {
      font-size: 2.25rem;
      font-weight: 700;
      color: #2c2c2c;
      letter-spacing: -0.02em;
    }

    .lead {
      font-size: 1.125rem;
      font-weight: 400;
      color: #4a4a4a;
      line-height: 1.6;
    }

    .btn-primary {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
      font-weight: 600;
      padding: 0.5rem 1.25rem;
      font-size: 0.95rem;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      transform: translateY(-1px);
    }

    .btn-outline-light {
      border-color: var(--text-light);
      color: var(--text-light);
      font-weight: 500;
    }

    .btn-outline-light:hover {
      background-color: var(--primary-color);
      color: var(--text-light);
      border-color: var(--primary-color);
    }

    .section-title {
      color: var(--primary-color);
      font-size: 1.5rem;
      font-weight: 600;
      letter-spacing: -0.01em;
    }

    .form-label {
      font-weight: 500;
      color: var(--text-dark);
      font-size: 0.95rem;
    }

    .form-control, .form-select {
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      font-size: 0.95rem;
      font-weight: 400;
      transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--secondary-color);
      outline: none;
      box-shadow: none;
    }

    .form-control.filled, .form-select.filled {
      border-color: var(--secondary-color);
    }

    .form-select option {
      padding: 10px;
    }

    .form-select option:checked {
      background-color: var(--secondary-color);
      color: white;
    }

    .event-tiles-container {
      width: 100%;
      margin: 0 auto;
    }

    .dates-container {
      background-color: #ffffff;
      border-radius: 12px;
      border: 1px solid var(--border-color);
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
    }

    .registered-date-content {
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      font-size: 0.85rem;
      line-height: 1.2;
    }

    .card-title {
      white-space: nowrap;
      font-size: 0.95rem;
      font-weight: 600;
    }

    @media (max-width: 576px) {
      .row-cols-sm-3 {
        --bs-gutter-x: 1rem;
      }
      .event-tiles-container .row {
        --bs-gutter-x: 1rem;
      }
      .page-title {
        font-size: 1.75rem;
      }
      .lead {
        font-size: 1rem;
      }
      .form-control, .form-select {
        font-size: 0.9rem;
      }
      .btn-primary {
        padding: 0.4rem 1rem;
        font-size: 0.9rem;
      }
      .card-title {
        font-size: 0.85rem;
      }
      .icon-circle {
        width: 48px;
        height: 48px;
      }
      .icon-circle i {
        font-size: 1.2rem;
      }
      .date-box {
        height: 90px;
        font-size: 0.85rem;
      }
      .registered-date-content {
        font-size: 0.75rem;
      }
    }

    @media (max-width: 768px) {
      .event-tiles-container .row {
        --bs-gutter-x: 1.5rem;
      }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 0.5s ease forwards;
    }
  </style>
</head>
<body>
  <div id="root"></div>

  <script src="https://cdn.jsdelivr.net/npm/react@18.2.0/umd/react.production.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/react-dom@18.2.0/umd/react-dom.production.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@babel/standalone@7.20.6/babel.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script type="text/babel">
    const { useState, useEffect } = React;

    const SpecialOccasionPage = () => {
      const [selectedOccasion, setSelectedOccasion] = useState(null);
      const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        date: '',
        time: '',
        guests: '',
        location: '',
        message: '',
        theme: '',
        specialRequirements: '',
        foodPreferences: '',
        ageGroup: '',
        venue: '',
      });
      const [isSubmitting, setIsSubmitting] = useState(false);
      const [isSubmitted, setIsSubmitted] = useState(false);

      const allPossibleDates = [
        "2025-05-15", "2025-05-16", "2025-05-17", 
        "2025-05-22", "2025-05-23", "2025-05-24",
        "2025-05-29", "2025-05-30", "2025-05-31",
        "2025-06-05", "2025-06-06", "2025-06-07"
      ];

      const registeredEvents = [
        { date: "2025-05-15", occasionId: 'birthday' },
        { date: "2025-05-22", occasionId: 'anniversary' },
        { date: "2025-05-29", occasionId: 'corporate' },
        { date: "2025-06-05", occasionId: 'custom' }
      ];

      const guestOptions = Array.from({length: 50}, (_, i) => (i + 1).toString());

      const occasionTypes = [
        {
          id: 'birthday',
          title: 'Birthday',
          icon: 'bi-gift',
          color: 'birthday',
          fields: [
            { name: 'name', label: 'Your Name', type: 'text', required: true },
            { name: 'email', label: 'Email Address', type: 'email', required: true },
            { name: 'phone', label: 'Contact Number', type: 'tel', required: true },
            { name: 'date', label: 'Birthday Date', type: 'date', required: true },
            { name: 'time', label: 'Time', type: 'time', required: true },
            { name: 'guests', label: 'Number of Guests', type: 'select', options: guestOptions, required: true },
            { name: 'ageGroup', label: 'Age Group', type: 'select', options: ['Kids (0-12)', 'Teens (13-19)', 'Adults (20+)', 'Mixed'], required: true },
            { name: 'theme', label: 'Party Theme', type: 'select', options: ['Superhero', 'Princess', 'Space Adventure', 'Jungle Safari', 'Under the Sea', 'Vintage Carnival', 'Glow Party', 'Custom'], required: false },
            { name: 'message', label: 'Additional Information', type: 'textarea', required: false },
          ]
        },
        {
          id: 'anniversary',
          title: 'Anniversary',
          icon: 'bi-calendar-heart',
          color: 'anniversary',
          fields: [
            { name: 'name', label: 'Your Name', type: 'text', required: true },
            { name: 'email', label: 'Email Address', type: 'email', required: true },
            { name: 'phone', label: 'Contact Number', type: 'tel', required: true },
            { name: 'date', label: 'Anniversary Date', type: 'date', required: true },
            { name: 'time', label: 'Time', type: 'time', required: true },
            { name: 'guests', label: 'Number of Guests', type: 'select', options: guestOptions, required: true },
            { name: 'location', label: 'Location', type: 'select', options: ['Indoor Venue', 'Outdoor Garden', 'Restaurant', 'Private Hall', 'Other'], required: true },
            { name: 'specialRequirements', label: 'Special Requirements', type: 'textarea', required: false },
            { name: 'message', label: 'Additional Information', type: 'textarea', required: false },
          ]
        },
        {
          id: 'corporate',
          title: 'Corporate Event',
          icon: 'bi-briefcase',
          color: 'corporate',
          fields: [
            { name: 'name', label: 'Your Name', type: 'text', required: true },
            { name: 'email', label: 'Email Address', type: 'email', required: true },
            { name: 'phone', label: 'Contact Number', type: 'tel', required: true },
            { name: 'date', label: 'Event Date', type: 'date', required: true },
            { name: 'time', label: 'Time', type: 'time', required: true },
            { name: 'guests', label: 'Number of Attendees', type: 'select', options: guestOptions, required: true },
            { name: 'venue', label: 'Venue Type', type: 'select', options: ['Conference Room', 'Banquet Hall', 'Outdoor', 'Hotel', 'Other'], required: true },
            { name: 'foodPreferences', label: 'Catering Requirements', type: 'select', options: ['Breakfast', 'Lunch', 'Dinner', 'Snacks Only', 'Full Day'], required: true },
            { name: 'message', label: 'Event Purpose & Requirements', type: 'textarea', required: false },
          ]
        },
        {
          id: 'custom',
          title: 'Custom Event',
          icon: 'bi-calendar2-plus',
          color: 'custom',
          fields: [
            { name: 'name', label: 'Your Name', type: 'text', required: true },
            { name: 'email', label: 'Email Address', type: 'email', required: true },
            { name: 'phone', label: 'Contact Number', type: 'tel', required: true },
            { name: 'date', label: 'Event Date', type: 'date', required: true },
            { name: 'time', label: 'Time', type: 'time', required: true },
            { name: 'guests', label: 'Number of Guests', type: 'select', options: guestOptions, required: true },
            { name: 'location', label: 'Location', type: 'select', options: ['Indoor Venue', 'Outdoor Garden', 'Restaurant', 'Private Hall', 'Other'], required: true },
            { name: 'message', label: 'Event Details & Requirements', type: 'textarea', required: true },
          ]
        }
      ];

      const registeredDates = registeredEvents.map(event => event.date);
      const availableDates = allPossibleDates.filter(date => !registeredDates.includes(date));

      const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({
          ...formData,
          [name]: value
        });
        
        if (e.target.value) {
          e.target.classList.add('filled');
        } else {
          e.target.classList.remove('filled');
        }
      };

      const handleSubmit = (e) => {
        e.preventDefault();
        setIsSubmitting(true);
        
        // Prepare the email data
        const emailData = {
          occasion_type: selectedOccasion.title,
          ...formData,
          date: new Date(formData.date).toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
          }),
          current_date: new Date().toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
          })
        };

        // Send email via EmailJS
        emailjs.send('service_bm0igyu', 'template_0cgaxfg', emailData)
          .then((response) => {
            console.log('SUCCESS!', response.status, response.text);
            setIsSubmitted(true);
          })
          .catch((error) => {
            console.error('FAILED...', error);
            alert('Failed to send booking request. Please try again later.');
          })
          .finally(() => {
            setIsSubmitting(false);
          });
      };

      useEffect(() => {
        setFormData({
          name: '',
          email: '',
          phone: '',
          date: '',
          time: '',
          guests: '',
          location: '',
          message: '',
          theme: '',
          specialRequirements: '',
          foodPreferences: '',
          ageGroup: '',
          venue: '',
        });
        setIsSubmitted(false);
      }, [selectedOccasion]);

      const renderField = (field) => {
        switch (field.type) {
          case 'text':
          case 'email':
          case 'tel':
          case 'date':
          case 'time':
            return (
              <input
                type={field.type}
                id={field.name}
                name={field.name}
                value={formData[field.name]}
                onChange={handleInputChange}
                className={`form-control ${formData[field.name] ? 'filled' : ''}`}
                required={field.required}
              />
            );
          case 'select':
            return (
              <select
                id={field.name}
                name={field.name}
                value={formData[field.name]}
                onChange={handleInputChange}
                className={`form-select ${formData[field.name] ? 'filled' : ''}`}
                required={field.required}
              >
                <option value="">Select {field.label}</option>
                {field.options.map((option) => (
                  <option key={option} value={option}>
                    {option}
                  </option>
                ))}
              </select>
            );
          case 'textarea':
            return (
              <textarea
                id={field.name}
                name={field.name}
                value={formData[field.name]}
                onChange={handleInputChange}
                rows={4}
                className={`form-control ${formData[field.name] ? 'filled' : ''}`}
                required={field.required}
              />
            );
          default:
            return null;
        }
      };

      return (
        <div className="container py-5">
          <div className="text-center mb-5 fade-in">
            <h1 className="page-title">Book Your Special Occasion</h1>
            <p className="lead">Select the type of event you'd like to celebrate with us</p>
          </div>

          {!selectedOccasion ? (
            <div className="row justify-content-center">
              <div className="col-md-10 col-lg-8">
                <div className="event-tiles-container mb-5 fade-in">
                  <div className="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                    {occasionTypes.map((occasion) => (
                      <div key={occasion.id} className="col">
                        <div
                          className={`card occasion-card ${occasion.color}`}
                          onClick={() => setSelectedOccasion(occasion)}
                        >
                          <div className="card-body text-center p-3">
                            <div className="icon-circle">
                              <i className={`bi ${occasion.icon}`}></i>
                            </div>
                            <h5 className="card-title">{occasion.title}</h5>
                          </div>
                        </div>
                      </div>
                    ))}
                  </div>
                </div>

                <div className="dates-container mt-5 fade-in">
                  <h2 className="section-title text-center mb-4">Registered Events</h2>
                  <div className="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                    {registeredEvents.map((event, index) => {
                      const occasion = occasionTypes.find(o => o.id === event.occasionId);
                      const formattedDate = new Date(event.date).toLocaleDateString('en-US', {
                        weekday: 'short',
                        month: 'short',
                        day: 'numeric'
                      });
                      return (
                        <div key={index} className="col">
                          <div className={`date-box ${occasion?.color}`}>
                            <div className="registered-date-content">
                              <i className="bi bi-calendar-date me-1 fw-bold"></i>
                              {formattedDate} - {occasion?.title}
                            </div>
                          </div>
                        </div>
                      );
                    })}
                  </div>
                </div>
              </div>
            </div>
          ) : (
            <div className="row justify-content-center">
              <div className="col-md-10 col-lg-8">
                <div className="card bg-white shadow fade-in">
                  <div className="form-header d-flex justify-content-between align-items-center">
                    <div className="d-flex align-items-center">
                      <div className="bg-white rounded-circle p-1 me-2 d-flex align-items-center justify-content-center" style={{width: "40px", height: "40px"}}>
                        <i className={`bi ${selectedOccasion.icon} fw-bold fs-4`} style={{color: '#003580'}}></i>
                      </div>
                      <h2 className="m-0 fs-5 fw-bold">{selectedOccasion.title} Booking</h2>
                    </div>
                    <button
                      onClick={() => setSelectedOccasion(null)}
                      className="btn btn-sm btn-outline-light"
                    >
                      Change
                    </button>
                  </div>

                  {!isSubmitted ? (
                    <div className="card-body p-5">
                      <form onSubmit={handleSubmit}>
                        <div className="row g-4">
                          {selectedOccasion.fields.map((field) => {
                            if (field.name === 'date') {
                              return (
                                <div key={field.name} className="col-12">
                                  <label className="form-label fw-bold">
                                    {field.label} {field.required && <span className="text-danger">*</span>}
                                  </label>
                                  <div className="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                                    {availableDates.map((date) => {
                                      const formattedDate = new Date(date).toLocaleDateString('en-US', {
                                        weekday: 'short',
                                        month: 'short',
                                        day: 'numeric'
                                      });
                                      return (
                                        <div key={date} className="col">
                                          <div 
                                            className={`date-box date-box-selectable ${formData.date === date ? 'selected' : ''}`}
                                            onClick={() => setFormData({...formData, date: date})}
                                          >
                                            <div className="registered-date-content">
                                              <i className="bi bi-calendar-date me-1 fw-bold"></i>
                                              {formattedDate}
                                            </div>
                                          </div>
                                        </div>
                                      );
                                    })}
                                  </div>
                                </div>
                              );
                            } else {
                              return (
                                <div key={field.name} className={field.type === 'textarea' ? 'col-12' : 'col-md-6'}>
                                  <label htmlFor={field.name} className="form-label fw-bold">
                                    {field.label} {field.required && <span className="text-danger">*</span>}
                                  </label>
                                  {renderField(field)}
                                </div>
                              );
                            }
                          })}
                        </div>

                        <div className="mt-5 d-grid gap-2 d-md-flex justify-content-md-end">
                          <button
                            type="submit"
                            disabled={isSubmitting}
                            className="btn btn-primary"
                          >
                            {isSubmitting ? (
                              <>
                                <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Submitting...
                              </>
                            ) : (
                              "Submit Booking Request"
                            )}
                          </button>
                        </div>
                      </form>
                    </div>
                  ) : (
                    <div className="card-body p-5 text-center fade-in">
                      <div className="icon-circle mb-4" style={{width: "72px", height: "72px"}}>
                        <i className="bi bi-check-lg fs-2 fw-bold"></i>
                      </div>
                      <h3 className="fs-3 fw-bold mb-3">Thank You!</h3>
                      <p className="text-muted mb-4 lead">
                        Your {selectedOccasion.title.toLowerCase()} booking request has been submitted successfully.
                        We'll contact you shortly via email to confirm your booking.
                      </p>
                      <button
                        onClick={() => setSelectedOccasion(null)}
                        className="btn btn-primary"
                      >
                        Book Another Event
                      </button>
                    </div>
                  )}
                </div>
              </div>
            </div>
          )}

          <div className="row justify-content-center mt-5">
            <div className="col-md-10 col-lg-8">
              <div className="contact-footer fade-in">
                <h3 className="section-title mb-4">Need Assistance?</h3>
                <div className="row g-4">
                  <div className="col-md-4">
                    <div className="d-flex">
                      <i className="bi bi-envelope fs-3 me-3" style={{color: '#003580'}}></i>
                      <div>
                        <p className="fw-bold mb-1">Email Us</p>
                        <p className="text-muted mb-0">bookings@yourwebsite.com</p>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-4">
                    <div className="d-flex">
                      <i className="bi bi-geo-alt fs-3 me-3" style={{color: '#003580'}}></i>
                      <div>
                        <p className="fw-bold mb-1">Visit Us</p>
                        <p className="text-muted mb-0">123 Booking Street, City</p>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-4">
                    <div className="d-flex">
                      <i className="bi bi-clock fs-3 me-3" style={{color: '#003580'}}></i>
                      <div>
                        <p className="fw-bold mb-1">Hours</p>
                        <p className="text-muted mb-0">Mon-Fri: 9am - 5pm</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      );
    };

    const root = ReactDOM.createRoot(document.getElementById('root'));
    root.render(<SpecialOccasionPage />);
  </script>

    <?php require('inc/footer.php');?>



</body>
</html>