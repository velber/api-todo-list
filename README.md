## API Todo List

This application uses Laravel Sanctum authentication system to make requests as auth user.

### Search, Sorting and Filters
Search, sortnig and filters can be applied to get list of tasks. It needs to add next parameters to Get request:
  - `search={value}` - specified needed value.
  - `sort={value}` - where value is needed field. To specify asc/desc sorting, add `-` to the begining of value, for example `-completedAt`
  - `filter[name]={value}` and `filter[value]={value}` - to apply filters.