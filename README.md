# Global Search Plugin for Kanboard

[![Open Source Love](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)]()
[![GitHub](https://img.shields.io/github/license/kenlog/global-search-kanboard?style=flat-square)](https://github.com/kenlog/global-search-kanboard/blob/master/LICENSE)
[![GitHub release](https://img.shields.io/github/release/kenlog/global-search-kanboard?style=flat-square)](https://github.com/kenlog/global-search-kanboard/releases/latest)
[![Downloads](https://img.shields.io/github/downloads/kenlog/global-search-kanboard/total.svg)](https://github.com/kenlog/global-search-kanboard/releases)

### Description
The **Global Search Plugin** adds a powerful global search functionality to Kanboard, allowing users to search for tasks, comments, and projects across all available projects they have access to. The search results are filtered by permissions, ensuring that users only see the content they are authorized to view. The search results can also be filtered to display only tasks, comments, or projects.

___

### Features
- Global search across tasks, comments, and projects.
- Filters to search only tasks, comments, or projects.
- Results sorted by most recent creation or modification date.
- Permission-based search: users see only the projects they have access to.

### Requirements
- Kanboard v1.2.32 or higher.
- A database supported by Kanboard (SQLite, MySQL, PostgreSQL).

### Installation
  **Plugin Manager**
  - Go to the Kanboard settings under the "Plugins" section, install the plugin in one click.

### Configuration
After installing the plugin, no additional configuration is required. The global search functionality is automatically added, allowing you to start using it immediately.

### Usage
- To access the global search, click on the avatar icon in the top right corner, then select the Global Search option from the list.
- You can apply filters to narrow down the results:
  - **Tasks**: Searches for tasks by title or description.
  - **Comments**: Searches for comments within tasks.
  - **Projects**: Searches for projects by name.
- The search results are sorted by the most recent date and limited to the projects the user has permission to view.

### Screenshot
![light](https://github.com/user-attachments/assets/e0ac942b-8cf6-4ec1-b68f-852c1473b491)
Multi theme and responsive compatibility
![dark](https://github.com/user-attachments/assets/a666a0ec-06cc-48f4-bf67-d9c88672fde9)

### Contributing
Contributions are welcome! If you have ideas or find any bugs, feel free to open an issue or submit a pull request.

### License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
