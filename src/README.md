# Laravel CRUD Test Assignment

Please read each note very carefully!
Feel free to add/change project structure to a clean architecture to your view.

Create a simple CRUD application with Laravel that implements the below model:
```
Customer {
	Firstname
	Lastname
	DateOfBirth
	PhoneNumber
	Email
	BankAccountNumber
}
```
## Practices and patterns (Must):

- [TDD](https://en.wikipedia.org/wiki/Test-driven_development)
- [DDD](https://en.wikipedia.org/wiki/Domain-driven_design)
- [BDD](https://en.wikipedia.org/wiki/Behavior-driven_development)
- [Clean architecture](https://github.com/jasontaylordev/CleanArchitecture)
- [CQRS](https://en.wikipedia.org/wiki/Command%E2%80%93query_separation#Command_query_responsibility_separation) pattern ([Event sourcing](https://en.wikipedia.org/wiki/Domain-driven_design#Event_sourcing)).
- Clean git commits that shows your work progress.
- Use PHP 8.2.x only
- Swagger

### Validations (Must)

- During Create; validate the phone number to be a valid *mobile* number only (Please use [Google LibPhoneNumber](https://github.com/google/libphonenumber) to validate number at the backend).

- A Valid email and a valid bank account number must be checked before submitting the form.

- Customers must be unique in database: By `Firstname`, `Lastname` and `DateOfBirth`.

- Email must be unique in the database.

### Storage (Must)

- Store the phone number in a database with minimized space storage.

### Delivery (Must)
- Please clone this repository in a new gitlab repository in private mode and share with ID: `bahadorbzd` in private mode on gitlab.com, make sure you do not erase my commits and then create a [Merge Request](https://docs.gitlab.com/ee/user/project/merge_requests/) (code review).
- Docker-compose project that loads database service automatically with `docker-compose up`

## Presentation (Nice To Have)
- Web UI.

