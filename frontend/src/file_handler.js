class FileHandler {
  createFolderStructure(data, currentLocationId) {
    const output = [];
    const temp = data.filter((e) => e.parent_id == currentLocationId)
      .filter((e) => e.type == "FOLDER")

    temp.sort((a, b) => b.name < a.name);

    temp.forEach((e) => {
      e.children = this.createFolderStructure(data, e.id);
      output.push(e);
    });

    return output;
  }
}

export default FileHandler