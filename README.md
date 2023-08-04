# Fleet Management System (Bus Booking System)
- The Bus Booking System facilitates seat reservations for trips that traverse multiple cities, including intermediate stops. For example, a trip from Cairo to Aswan may pass through Alfayoum, Almenya, and Sohag.
- Users have the freedom to reserve available seats for trips connecting any two cities along the designated route.
- The system rigorously enforces validations to ensure that users can exclusively book seats that are currently available.
## What This Project Offers:

- The Admin Area empowers administrators to efficiently manage cities, buses, trips, and bookings.
- The system offers a range of APIs:
  - Authentication APIs (Login, Registration)
  - Trips APIs (Search for available seats, Book available seat) (*Note: These APIs are accessible to authenticated users only*)

## Admin Area Access:

- Simply open the web application's homepage, and you will be automatically redirected to the dashboard login. No additional configurations are required except installing the provided database dump located in the project's designated database folder.

## Admin Credentials:

- Email: admin@admin.com
- Password: fl$$t@pp
## API Documentation:

### Registration

**POST** `/api/register`

**Body**:

```json
{
    "name": "willsmith",
    "email": "willsmith@email.com",
    "password": "12345"
}
```
**Response**:
```json
{
    "data": {
        "user": {
            "name": "willsmith",
            "email": "willsmith@email.com",
            "updated_at": "2023-08-04T00:09:00.000000Z",
            "created_at": "2023-08-04T00:09:00.000000Z",
            "id": 22,
            "profile_photo_url": "https://ui-avatars.com/api/?name=A&color=7F9CF5&background=EBF4FF"
        }
    },
    "message": "User account created."
}
```

### Login:
**POST** `/api/login`

**Body**:

```json
{
    "email": "willsmith@email.com",
    "password": "12345"
}
```

**Response**:
```json
{
    "data": {
        "user": {
            "id": 22,
            "name": "Ahmed",
            "email": "ahmed@zekry.com",
            "email_verified_at": null,
            "two_factor_confirmed_at": null,
            "current_team_id": null,
            "profile_photo_path": null,
            "created_at": "2023-08-04T00:09:00.000000Z",
            "updated_at": "2023-08-04T00:09:00.000000Z",
            "profile_photo_url": "https://ui-avatars.com/api/?name=A&color=7F9CF5&background=EBF4FF"
        },
        "token": "1|DwnF8EnHc8Y9rhDcY1S0Tl4LBK2hWXWPlxomIP7d"
    },
    "mesasge": "Successful login"
}
```

### Find Available Seats For Specific Origin and Destination:
**POST** `/api/trips/find-available-seats`

**Body**:

```json
{
    "origin_city_id": 1,
    "destination_city_id": 7
}
```

**Response**:
```json
{
    "data": {
        "available_seats": [
            {
                "seat_id": 2,
                "seat_number": "1613f",
                "trip_id": 1,
                "bus_id": 1,
                "trip_number": "T9980",
                "bus_plate_number": "B-335"
            },
            {
                "seat_id": 17,
                "seat_number": "a0d34",
                "trip_id": 2,
                "bus_id": 2,
                "trip_number": "T8795",
                "bus_plate_number": "B-549"
            }
        ]
    }
}
```

### Book Available Seat For Specific Origin and Destination:
**POST** `/api/trips/find-available-seats`

**Body**:

```json
{
    "trip_id": 1,
    "seat_id": 2,
    "origin_city_id": 1,
    "destination_city_id": 7
}
```

**Response**:
```json
{
    "data": {
        "booking": {
            "trip_id": 1,
            "seat_id": 2,
            "user_id": 22,
            "origin_city_id": 1,
            "destination_city_id": 7,
            "intermediate_cities": [
                2,
                3,
                5,
                4,
                6
            ],
            "updated_at": "2023-08-04T01:09:27.000000Z",
            "created_at": "2023-08-04T01:09:27.000000Z",
            "id": 3
        }
    },
    "message": "Congratuations, your seat has been bookd. Have a nice trip :)"
}
```
