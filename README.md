# Global Search Plugin for Kanboard

[![Open Source Love](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)]()
[![GitHub](https://img.shields.io/github/license/kenlog/global-search-kanboard?style=flat-square)](https://github.com/kenlog/global-search-kanboard/blob/master/LICENSE)
[![GitHub release](https://img.shields.io/github/release/kenlog/global-search-kanboard?style=flat-square)](https://github.com/kenlog/global-search-kanboard/releases/latest)
[![Downloads](https://img.shields.io/github/downloads/kenlog/global-search-kanboard/total.svg)](https://github.com/kenlog/global-search-kanboard/releases)

### Description
The **Global Search Plugin** adds a powerful global search functionality to Kanboard, allowing users to search for tasks, comments, and projects across all available projects they have access to. The search results are filtered by permissions, ensuring that users only see the content they are authorized to view. The search results can also be filtered to display only tasks, comments, or projects.

![GlobalSearch](https://github.com/user-attachments/assets/236a84bd-11b1-410f-8922-da48fefbbdc2)

### Features
- Global search across tasks, comments, and projects.
- Filters to search only tasks, comments, or projects.
- Results sorted by most recent creation or modification date.
- Permission-based search: users see only the projects they have access to.

### Requirements
- Kanboard v1.2.32 or higher.
- PHP 7.4 or higher.
- A database supported by Kanboard (SQLite, MySQL, PostgreSQL).

### Installation

  **Plugin Manager**
  - Go to the Kanboard settings under the "Plugins" section, install the plugin in one click.

### Configuration
After installing the plugin, no further configuration is required. The global search functionality is automatically added to the top menu, and you can start using it immediately.

You can filter the search results by selecting specific options (tasks, comments, projects) and see the most recent items first.

### Usage
- Use the search bar located in the header of your Kanboard installation to search for tasks, comments, or projects.
- You can apply filters to narrow down the results:
  - **Tasks**: Searches for tasks by title or description.
  - **Comments**: Searches for comments within tasks.
  - **Projects**: Searches for projects by name.
- The search results are sorted by the most recent date and limited to the projects the user has permission to view.

<!-- ### Screenshot
![Global Search Plugin Screenshot](screen.png) -->

### Contributing
Contributions are welcome! If you have ideas or find any bugs, feel free to open an issue or submit a pull request.

### License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
