package iteration

func Repeat(character string, number int) string {
    text := ""
    for i:=0; i < number; i++ {
      text += character
    }

    return text
}