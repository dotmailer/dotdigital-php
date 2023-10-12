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
