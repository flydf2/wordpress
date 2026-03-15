# WordPress 极简新闻主题文件结构建议

## 核心文件

### 首页相关
- `index.php` - 首页模板，遍历所有分类并显示最新文章
- `front-page.php` - 首页模板（可选，如果需要不同的首页布局）

### 文章相关
- `single.php` - 文章详情页模板，左侧内容+右侧侧边栏布局
- `archive.php` - 分类归档页模板

### 功能支持
- `functions.php` - 主题功能定义，包括面包屑函数、脚本入队等
- `style.css` - 主题样式文件

### 模板部分
- `template-parts/` - 模板部分目录
  - `content/` - 内容相关模板
    - `content-single.php` - 文章内容模板
  - `sidebar/` - 侧边栏模板
    - `sidebar.php` - 右侧侧边栏模板

### 脚本文件
- `js/` - JavaScript 文件目录
  - `markdown-it.min.js` - Markdown 解析库
  - `mermaid.min.js` - Mermaid 图表库
  - `blogmate-markdown.js` - 自定义 Markdown 处理脚本
  - `blogmate-mermaid.js` - 自定义 Mermaid 处理脚本

### 配置文件
- `inc/` - 包含文件目录
  - `customizer/` - 主题定制器配置

## 实现说明

1. **首页**：使用 `get_categories()` 函数获取所有分类，遍历每个分类并显示最新 10 篇文章。
2. **详情页**：采用左侧内容 + 右侧侧边栏布局，支持 Markdown 内容渲染和 Mermaid 图表显示。
3. **侧边栏**：包含标签云、全部分类列表、最近更新文章列表。
4. **样式**：使用基础 CSS 或 Tailwind CSS，实现响应式布局。
5. **功能**：在 `functions.php` 中添加面包屑函数和必要的脚本入队。