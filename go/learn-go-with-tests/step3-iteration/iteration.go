package iteration

func Repeat(character string) string {
    text := ""
    for i:=0; i < 5; i++ {
      text += character
    }

    return text
}