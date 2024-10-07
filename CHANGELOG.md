# 2.6.0

### What's new
- Responses with a 429 (Too Many Requests) error code now trigger a specific exception with properties exposing additional information (the call scope, rate limit and time to retry).

### Bug fixes
- `Contact::setDataFields()` no longer breaks if passed an empty array.

# 2.5.0

### Improvements
- The SDK now supports checking V3 InsightData imports by id.
- We added setter methods for Contact ChannelProperty models.
- Some nested model type requirements have been relaxed.
- nesbot/carbon is removed in favour of native DateTime.

# 2.4.1

### Improvements
- We added an annotation to the Import model for a FailureCollection.

### Bug fixes
- The `$respondentNotificationCampaignId` property of the Survey model was changed from string to int.

# 2.4.0

### What's new
- We added a method to update or create contact insight data.

### Improvements
- We added an annotation for the `getStatus()` method in the Contact model, to fix PHPStan errors.

# 2.3.1

### Improvements
- It's now possible to call `$contact→setDatafields()` passing an empty array.

# 2.3.0

### What's new
- We've added a new V3 InsightData resource, with two PUT methods for bulk import and single upsert.

# 2.2.0

### What's new
- We've added a new resource for fetching surveys, pages and forms via the V2 API.

# 2.1.0

### What's new
- We added a `patchByIdentifier` method to the V3 Contacts resource.

### Improvements
- We added `skip` and `select` params to the V2 `show()` method for address books (lists).
- We added `@method` docblocks to selected V3 models.

# 2.0.0

### What's new
- The SDK now wraps version 2 and version 3 of the Dotdigital API.
- We have wrapped a subset of methods for the V3 contacts service, including create, get by identifier, import and get import by id.

### Improvements
- A `getType` accessor method was added to the V2 DataField model.

# 1.0.0

- This first version covers a limited set of resources (Account, Contacts, Address Books, Data Fields and Programs) with just a small subset of methods wrapped for each of these.
- v1 is bundled with one of our WordPress plugins, so it currently fits that use case.
