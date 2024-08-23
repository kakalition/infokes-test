class API {
  getFolders(onComplete) {
    fetch(`${import.meta.env.VITE_BASE_API_URL}/api/folders`, {
      method: "GET",
    }).then(onComplete)
  }

  getFolderContent(id, onComplete) {
    if (id == null) {
      return;
    }

    return fetch(`${import.meta.env.VITE_BASE_API_URL}/api/folders/${id}/files`, {
      method: "GET",
    }).then(onComplete)
  }

  createFolder(parentId, name) {
    return fetch(`${import.meta.env.VITE_BASE_API_URL}/api/folders`, {
      method: "POST",
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        parent_id: parentId,
        name,
      })
    })
  }

  updateFolder(id, name) {
    return fetch(`${import.meta.env.VITE_BASE_API_URL}/api/folders/${id}`, {
      method: "PUT",
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        name,
      })
    })
  }

  deleteFolder(id) {
    return fetch(`${import.meta.env.VITE_BASE_API_URL}/api/folders/${id}`, {
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
      method: "DELETE",
    })
  }

  createFile(parentId, name) {
    return fetch(`${import.meta.env.VITE_BASE_API_URL}/api/files`, {
      method: "POST",
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        parent_id: parentId,
        name,
      })
    })
  }

  updateFile(id, name) {
    return fetch(`${import.meta.env.VITE_BASE_API_URL}/api/files/${id}`, {
      method: "PUT",
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        name,
      })
    })
  }

  deleteFile(id) {
    return fetch(`${import.meta.env.VITE_BASE_API_URL}/api/files/${id}`, {
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
      method: "DELETE",
    })
  }

  pasteObject(action, targetId, destinationId) {
    return fetch(`${import.meta.env.VITE_BASE_API_URL}/api/cut_copy_paste`, {
      method: "POST",
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        action,
        target_id: targetId,
        destination_id: destinationId,
      })
    })
  }
}

export default API